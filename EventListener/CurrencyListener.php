<?php

namespace YV\MultiCurrencyBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;

use YV\MultiCurrencyBundle\Event\ChangeAmountEvent;

use YV\MultiCurrencyBundle\Entity\User;
use YV\MultiCurrencyBundle\Entity\Account;
use YV\MultiCurrencyBundle\Entity\CurrencyAccount;
use YV\MultiCurrencyBundle\Entity\Currency;
use YV\MultiCurrencyBundle\Entity\Transaction;

class CurrencyListener
{

    protected $config;
    protected $entityManager;
    protected $userClass;
    protected $accountClass;
    protected $currencyClass;
    protected $currencyAccountClass;
    protected $transactionClass;
    protected $mailer;
    protected $twig;
    
    /**
     * Constructs a new instance of CurrencyListener.
     *
     */
    public function __construct($entityManager, array $config, \Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->config = array_merge($this->getDefaultConfig(), $config);
        $this->mailer = $mailer;
        $this->twig = $twig;

        $this->userClass = $this->config['user_class'];
        $this->accountClass = $this->config['account_class'];
        $this->currencyClass = $this->config['currency_class'];
        $this->currencyAccountClass = $this->config['currency_account_class'];
        $this->transactionClass = $this->config['transaction_class'];
    }

    /**
     * Change currency account amount.
     *
     * @param ChangeAmountEvent $event The event
     */
    public function onChangeAmount(ChangeAmountEvent $event)
    {
        $user = $event->getUser();
        /* @var $user User */

        $account = $this->getAccount($user);
        /* @var $account Account */
        
        $currencyAccount = $this->getCurrencyAccount($account, $event->getCurrency());
        /* @var $currencyAccount CurrencyAccount */
        
        $context = array(
            'user' => $user,
            'currency' => $event->getCurrency(),
            'account' => $account,
            'currency_account' => $currencyAccount,
            'amount' => $event->getAmount(),
            'title' => $event->getTitle(),
            'success' => true
        );
        
        if($currencyAccount->changeAmount($event->getAmount())) {
            // success
            $this->entityManager->persist($currencyAccount);
            
            $transaction = $this->getObject($this->transactionClass);
            /* @var $transaction Transaction */
            
            $transaction->setTitle($event->getTitle());
            $transaction->setAmount($event->getAmount());
            $transaction->setCurrencyAccount($currencyAccount);
            $this->entityManager->persist($transaction);
            $this->entityManager->flush();
        } else {
            // not enough currency amount
            $context['success'] = false;
        }
        
        $toEmail = array($user->getEmail() => $user->getName());
        
        $this->sendMessage('YVMultiCurrencyBundle:emails:currency_account_amount_change.html.twig', $context, $toEmail);
    }

    /**
     * @param string $class
     * @return Object
     */
    private function getObject($class)
    {
        return new $object;
    }
    
    /**
     * get account
     * 
     * @param User $user
     */
    private function getAccount(User $user)
    {
        $account = $user->getAccount();
        /* @var $account Account */        

        if ($account === null) {
            $account = $this->getObject($this->accountClass);
            $account->setUser($user);

            $currencyAccount = $this->getObject($this->currencyAccountClass);
            /* @var $currencyAccount CurrencyAccount */
            
            $this->entityManager->persist($currencyAccount);
        
            $account->addCurrencyAccount($currencyAccount);
            $this->entityManager->persist($account);
            $this->entityManager->flush();
        }
        
        return $account;
    }
    
    /**
     * get currency account
     * 
     * @param Account $account
     * @param Currency $currency
     * 
     * @return CurrencyAccount
     */
    private function getCurrencyAccount(Account $account, Currency $currency)
    {
        $currencyAccount = $account->getCurrencyAccount($currency);
        /* @var $currencyAccount CurrencyAccount */
        
        if ($currencyAccount === null) {
            $currencyAccount = $this->getObject($this->currencyAccountClass);
            $currencyAccount->setAccount($account);
            
            $this->entityManager->persist($currencyAccount);
            $this->entityManager->flush();
        }
        
        return $currencyAccount;
    }
    
    /**
     * send email
     * 
     * @param string $templateName
     * @param array $context
     * @param array $toEmail
     */
    protected function sendMessage($templateName, array $context, array $toEmail)
    {
        $fromEmail = $this->config['email']['from_email'];
        $template = $this->twig->loadTemplate($templateName);
        $subject = $template->renderBlock('subject', $context);
        $textBody = $template->renderBlock('body_text', $context);
        $htmlBody = $template->renderBlock('body_html', $context);

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($fromEmail)
            ->setTo($toEmail);

        if (!empty($htmlBody)) {
            $message->setBody($htmlBody, 'text/html')
                ->addPart($textBody, 'text/plain');
        } else {
            $message->setBody($textBody);
        }

        $this->mailer->send($message);
    }
    
    /**
     * @return array
     */
    
    private function getDefaultConfig()
    {
        return array(
            'email' => array('from_email' => ''),
            
            'user_class' => 'YV\MultiCurrencyBundle\Entity\User',
            'account_class' => 'YV\MultiCurrencyBundle\Entity\Account',
            'currency_class' => 'YV\MultiCurrencyBundle\Entity\Currency',
            'currency_account_class' => 'YV\MultiCurrencyBundle\Entity\CurrencyAccount',
            'transaction_class' => 'YV\MultiCurrencyBundle\Entity\Transaction',
        );        
    }
}
