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
 * DubManArticles Model
 *
 * @method \DubManual\Model\Entity\DubManArticle newEmptyEntity()
 * @method \DubManual\Model\Entity\DubManArticle newEntity(array $data, array $options = [])
 * @method array<\DubManual\Model\Entity\DubManArticle> newEntities(array $data, array $options = [])
 * @method \DubManual\Model\Entity\DubManArticle get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \DubManual\Model\Entity\DubManArticle findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \DubManual\Model\Entity\DubManArticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\DubManual\Model\Entity\DubManArticle> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \DubManual\Model\Entity\DubManArticle|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \DubManual\Model\Entity\DubManArticle saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\DubManual\Model\Entity\DubManArticle>|\Cake\Datasource\ResultSetInterface<\DubManual\Model\Entity\DubManArticle>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\DubManual\Model\Entity\DubManArticle>|\Cake\Datasource\ResultSetInterface<\DubManual\Model\Entity\DubManArticle> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\DubManual\Model\Entity\DubManArticle>|\Cake\Datasource\ResultSetInterface<\DubManual\Model\Entity\DubManArticle>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\DubManual\Model\Entity\DubManArticle>|\Cake\Datasource\ResultSetInterface<\DubManual\Model\Entity\DubManArticle> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DubManArticlesTable extends Table
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

        $this->setTable('dub_man_articles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('DubManTopics', [
            'foreignKey' => 'topic_id',
            'className' => 'DubManual.DubManTopics'
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
                ->where(['topic_id' => $data['topic_id']])
                ->orderBy(['sort_order' => 'DESC'])
                ->first();

            $data['sort_order'] = $lastSortOrder ? $lastSortOrder->sort_order + 10 : 10;
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
            ->allowEmptyString('name');

        $validator
            ->scalar('article')
            ->allowEmptyString('article');

        $validator
            ->allowEmptyString('img')
            ->add('img', 'fileExtension', [
                'rule' => function ($value, $context) {
                    if (empty($value)) {
                        return true; // 空の場合はOK
                    }
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $extension = strtolower(pathinfo($value, PATHINFO_EXTENSION));
                    return in_array($extension, $allowedExtensions);
                },
                'message' => '許可されているファイル形式は jpg, jpeg, png, gif のみです。'
            ]);

        $validator
            ->integer('sort_order')
            ->requirePresence('sort_order', 'create')
            ->notEmptyString('sort_order');

        return $validator;
    }
}
