<?php
header("Content-Type: text/html;charset=utf-8");
ini_set("memory_limit", "1024M");
require dirname(__FILE__) . '/../core/init.php';

/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    // 爬虫名称
    'name' => '点点租',
    // 同时工作的爬虫任务数
    'tasknum' => 8,
    // 采集失败后尝试的次数
    'max_try' => 5,
    // 导出的数据格式
    'export' => array(
        'type' => 'db',
        'table' => 'diandianzu',
    ),
    // 爬虫采集的域名
    'domains' => array(
        'sh.diandianzu.com',
        'www.sh.diandianzu.com',
    ),
    // 爬虫入口
    'scan_urls' => array(
        'http://sh.diandianzu.com/listing/p1/',
    ),
    // 内容页url
    'content_url_regexes' => array(
        'http://sh.diandianzu.com/listing/detail-i\d+$',
    ),
    // 列表页url
    'list_url_regexes' => array(
        'http://sh.diandianzu.com/listing/p1/',
        'http://sh.diandianzu.com/listing/p1/\d+',
        'http://sh.diandianzu.com/listing/p1/.*?',
    ),
    // 定义内容以抽取规则
    'fields' => array(
        // 童鞋名称
        array(
            'name' => 'name',
            'selector' => '/html/body/div[1]/div[2]/div/div[1]/div/div[1]/div[2]/div[1]/h1',
        ),
        // 性别
        array(
            'name' => 'price',
            'selector' => '/html/body/div[1]/div[2]/div/div[1]/div/div[1]/div[2]/div[2]/span',
        ),
        // 学习时长
        array(
            'name' => 'description',
            'selector' => '/html/body/div[1]/div[2]/div/div[2]/div[4]/div[6]/div[1]',
        ),
        // 积分
        array(
            'name' => 'housingRes',
            'selector' => '/html/body/div[1]/div[2]/div/div[2]/div[2]/div[1]/ul/li[1]/span[2]',
        ),
        // 积分
        array(
            'name' => '100m²',
            'selector' => '/html/body/div[1]/div[2]/div/div[2]/div[2]/div[1]/ul/li[2]/span[2]',
        ),
        // 积分
        array(
            'name' => '100m-200m²',
            'selector' => '/html/body/div[1]/div[2]/div/div[2]/div[2]/div[1]/ul/li[3]/span[2]',
        ),
        // 积分
        array(
            'name' => '200m-300m²',
            'selector' => '/html/body/div[1]/div[2]/div/div[2]/div[2]/div[1]/ul/li[4]/span[2]',
        ),
        // 积分
        array(
            'name' => '300m-500m²',
            'selector' => '/html/body/div[1]/div[2]/div/div[2]/div[2]/div[1]/ul/li[5]/span[2]',
        ),
        // 积分
        array(
            'name' => '500m-1000m²',
            'selector' => '/html/body/div[1]/div[2]/div/div[2]/div[2]/div[1]/ul/li[6]/span[2]',
        ),
        // 积分
        array(
            'name' => '1000m²以上',
            'selector' => '/html/body/div[1]/div[2]/div/div[2]/div[2]/div[1]/ul/li[7]/span[2]',
        ),
        // 经验
        array(
            'name' => 'address',
            'selector' => '/html/body/div[1]/div[2]/div/div[2]/div[4]/div[1]/ul/li[2]/span[2]/a',
//            'selector' => '/html/body/div[3]/div[3]/div[2]/div[3]/p[1]/a[1]'.'/html/body/div[3]/div[3]/div[2]/div[3]/p[1]/a[2]'.'/html/body/div[3]/div[3]/div[2]/div[3]/p[1]/text()[3]',
        ),
        // 描述
        array(
            'name' => 'distanceSubway',
            'selector' => '/html/body/div[1]/div[2]/div/div[1]/div/div[2]/p[1]/a[4]',
        ),
        // 描述
        array(
            'name' => 'longitude',
            'selector' => '//*[@id="longitude"]',
        ),
        // 描述
        array(
            'name' => 'latitude',
            'selector' => '//*[@id="latitude"]',
        ),
        // 关注
        array(
            'name' => 'tel',
            'selector' => '/html/body/div[1]/div[2]/div/div[2]/div[1]/div[2]/div[2]/p[2]',
        ),
         // 关注
        array(
            'name' => 'img',
            'selector' => '/html/body/div[1]/div[2]/div/div[1]/div/div[3]/div[1]/div[1]/div/div[1]/img',
        )
    ),
);


$spider = new phpspider($configs);

$spider->on_start = function ($spider) {
    for ($i = 0; $i <= 30000; $i++) {
        $url = "http://sh.diandianzu.com/listing/detail-i{$i}";
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
