<?php

namespace YV\MultiCurrencyBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

use YV\MultiCurrencyBundle\Model\ModelInterface\UserInterface;
use YV\MultiCurrencyBundle\Model\ModelInterface\CurrencyInterface;

/**
 * TransactionRepository
 */
class TransactionRepository extends EntityRepository
{
    /**
     * @param UserInterface $user
     * @param integer $limit
     * 
     * @return ArrayCollection
     */
    public function findTransactionsByUser(UserInterface $user, $limit = false)
    {
        return $this->getTransactionsQuery($user, null, $limit)->getResult();
    }
    
    /**
     * @param UserInterface $user
     * @param CurrencyInterface $currency
     * @param integer $limit
     * 
     * @return ArrayCollection
     */
    public function findTransactionsByUserAndCurrency(UserInterface $user, CurrencyInterface $currency, $limit = false)
    {   
        return $this->getTransactionsQuery($user, $currency, $limit)->getResult();
    }
    
    /**
     * @param CurrencyInterface $currency
     * @param integer $limit
     * 
     * @return ArrayCollection
     */
    public function findTransactionsByCurrency(CurrencyInterface $currency, $limit = false)
    {
        return $this->getTransactionsQuery(null, $currency, $limit)->getResult();
    }
 
    /**
     * @param UserInterface $user
     * @param CurrencyInterface $currency
     * @pram integer $limit
     * 
     * @return Query
     */
    public function getTransactionsQuery($user = null, $currency = null, $limit = false)
    {
        $queryBuilder = $this->createQueryBuilder('t')
                ->innerJoin('t.currencyAccount', 'ca')
                ->innerJoin('ca.account', 'a');
        
        if($user) {
            $queryBuilder->where('a.user = :user')
                ->setParameter('user', $user->getId());
        }
        
        if($currency){
            $queryBuilder->where('a.currency = :currency')
                ->setParameter('currency', $currency->getId());
        }
        
        if($limit) {
            $queryBuilder->setMaxResults(intval($limit));
        }
        
        return $queryBuilder
                ->orderBy('t.id', 'DESC')
                ->getQuery();
    }
}
