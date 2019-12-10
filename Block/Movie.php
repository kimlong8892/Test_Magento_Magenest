<?php


namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;

class Movie extends Template
{
    private $_movieCollectionFactory;
    private $_actorCollectionFactory;

    public function __construct(
        Template\Context $context,
        \Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory $movieCollectionFactory,
        \Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory $actorCollectionFactory,
        array $data = [])
    {
        $this->_movieCollectionFactory = $movieCollectionFactory;
        $this->_actorCollectionFactory = $actorCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getMovie()
    {
        $collection = $this->_movieCollectionFactory->create();
        $joinConditions = 'main_table.director_id = dir.director_id';
        $collection->getSelect()->reset(\Zend_Db_Select::COLUMNS)
            ->columns([
                'name_movie' => 'main_table.name',
                'name_dir' => 'dir.name',
                'rating' => 'rating',
                'description' => 'description',
                'movie_id' => 'movie_id'
            ])->joinInner(
                ['dir' => $collection->getTable('magenest_director')],
                $joinConditions,
                []
            );
        return $collection;
    }

    public function getActor($movie_id)
    {
        $collection = $this->_actorCollectionFactory->create();
        $joinConditions = 'main_table.actor_id = movie_actor.actor_id';
        $collection->getSelect()->reset(\Zend_Db_Select::COLUMNS)
            ->columns([
                'name' => 'main_table.name',
                'movie_id' => 'movie_actor.movie_id'
            ])->joinInner(
                ['movie_actor' => $collection->getTable('magenest_movie_actor')],
                $joinConditions,
                []
            );
        $collection->addFieldToFilter("movie_id", $movie_id);
        return $collection;
    }
}