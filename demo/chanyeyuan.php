<?php
ini_set("memory_limit", "1024M");
require dirname(__FILE__) . '/../core/init.php';

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    // 爬虫名称
    'name' => '好租',
    // 同时工作的爬虫任务数
    'tasknum' => 8,
    // 采集失败后尝试的次数
    'max_try' => 5,
    // 导出的数据格式
    'export' => array(
        'type' => 'db',
        'table' => 'chanyeyuan',
    ),
    // 爬虫采集的域名
    'domains' => array(
        'haozu.com',
        'www.haozu.com',
    ),
    // 爬虫入口
    'scan_urls' => array(
        'https://www.haozu.com/sh_xzl_2636/',
    ),
    // 内容页url
    'content_url_regexes' => array(
        'https://www.haozu.com/sh_xzl_\d+$',
    ),
    // 列表页url
    'list_url_regexes' => array(
        'https://www.haozu.com/sh/zuxiezilou/a6/',
        'https://www.haozu.com/sh/zuxiezilou/a6/\d+',
        'https://www.haozu.com/sh/zuxiezilou/a6/.*?',
    ),
    // 定义内容以抽取规则
    'fields' => array(
        // 童鞋名称
        array(
            'name' => 'name',
            'selector' => '/html/body/div[3]/div[3]/div[2]/div[1]/h1',
        ),
        // 性别
        array(
            'name' => 'price',
            'selector' => '/html/body/div[3]/div[3]/div[2]/div[1]/p/i',
        ),
        // 学习时长
        array(
            'name' => 'housingRes',
            'selector' => '/html/body/div[3]/div[3]/div[2]/div[2]/dl[1]/dt',
        ),
        // 积分
        array(
            'name' => 'availableArea',
            'selector' => '/html/body/div[3]/div[3]/div[2]/div[2]/dl[2]/dt/text()',
        ),
        // 经验
        array(
            'name' => 'address',
            'selector' => '/html/body/div[3]/div[3]/div[2]/div[3]/p[1]',
//            'selector' => '/html/body/div[3]/div[3]/div[2]/div[3]/p[1]/a[1]'.'/html/body/div[3]/div[3]/div[2]/div[3]/p[1]/a[2]'.'/html/body/div[3]/div[3]/div[2]/div[3]/p[1]/text()[3]',
        ),
        // 描述
        array(
            'name' => 'distanceSubway',
            'selector' => '/html/body/div[3]/div[3]/div[2]/div[3]/p[2]/text()',
        ),
        // 关注
        array(
            'name' => 'tel',
            'selector' => '/html/body/div[3]/div[3]/div[2]/div[5]/i',
        )
    ),
);


$spider = new phpspider($configs);

$spider->on_start = function ($spider) {
    for ($i = 0; $i <= 30000; $i++) {
        $url = "https://www.haozu.com/sh_xzl_{$i}";
        $spider->add_url($url);
    }
};

$spider->on_extract_field = function ($fieldname, $data, $page) {
    if ($fieldname == 'url') {
        $data = $page['url'];
    }

    return $data;
};

$spider->start();
