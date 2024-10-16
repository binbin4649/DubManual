<?php

declare(strict_types=1);
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) NPO baser foundation <https://baserfoundation.org/>
 *
 * @copyright     Copyright (c) NPO baser foundation
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.7
 * @license       https://basercms.net/license/index.html MIT License
 */

namespace DubManual\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DubManTopics Model
 *
 * @method \DubManual\Model\Entity\DubManTopic newEmptyEntity()
 * @method \DubManual\Model\Entity\DubManTopic newEntity(array $data, array $options = [])
 * @method array<\DubManual\Model\Entity\DubManTopic> newEntities(array $data, array $options = [])
 * @method \DubManual\Model\Entity\DubManTopic get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \DubManual\Model\Entity\DubManTopic findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \DubManual\Model\Entity\DubManTopic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\DubManual\Model\Entity\DubManTopic> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \DubManual\Model\Entity\DubManTopic|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \DubManual\Model\Entity\DubManTopic saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\DubManual\Model\Entity\DubManTopic>|\Cake\Datasource\ResultSetInterface<\DubManual\Model\Entity\DubManTopic>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\DubManual\Model\Entity\DubManTopic>|\Cake\Datasource\ResultSetInterface<\DubManual\Model\Entity\DubManTopic> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\DubManual\Model\Entity\DubManTopic>|\Cake\Datasource\ResultSetInterface<\DubManual\Model\Entity\DubManTopic>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\DubManual\Model\Entity\DubManTopic>|\Cake\Datasource\ResultSetInterface<\DubManual\Model\Entity\DubManTopic> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DubManTopicsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('dub_man_topics');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('DubManCategories', [
            'foreignKey' => 'category_id',
            'className' => 'DubManual.DubManCategories'
        ]);

        $this->hasMany('DubManArticles', [
            'foreignKey' => 'topic_id',
            'className' => 'DubManual.DubManArticles',
            'order' => ['sort_order' => 'ASC'],
            'dependent' => true
        ]);

        $this->addBehavior('Timestamp');
    }

    /**
     * beforeMarshal
     *
     * @param \Cake\Event\EventInterface $event イベントオブジェクト
     * @param \ArrayObject $data データ
     * @param \ArrayObject $options オプション
     * @return void
     */
    public function beforeMarshal(\Cake\Event\EventInterface $event, \ArrayObject $data, \ArrayObject $options)
    {
        // 並び順が空の場合、次の番号を取得して設定
        if (empty($data['sort_order'])) {
            $lastSortOrder = $this->find()
                ->select(['sort_order'])
                ->where(['category_id' => $data['category_id']])
                ->orderBy(['sort_order' => 'DESC'])
                ->first();

            $data['sort_order'] = $lastSortOrder ? $lastSortOrder->sort_order + 10 : 10;
        }

        if (empty($data['is_publish'])) {
            $data['is_publish'] = true;
        }
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmptyString('sort_order');

        $validator
            ->boolean('is_publish')
            ->requirePresence('is_publish', 'create')
            ->notEmptyString('is_publish');

        return $validator;
    }
}