@extends('layouts.app')

@section('content')

    <div class="top_thumb">
        <div class="loop_wrap">
          <img src="/images/site-top-image.png" class="img-fluid">
        </div>
        <p>
          <img src="/images/logo.png" class="img-fluid align-middle" width="150" alt="brand-image">
        </p>
    </div>
    
    <h3 id="find-souvenirs" class="mt-5">お土産を探す</h3>
    
    <div id="select_prefecture">
        <img src="/images/prefectures.png">
      
        <div id="area1">
          <div id="area_button_1" class="btn btn-light" data-toggle="collapse" data-target="#area_target_1" aria-expanded="false" aria-controls="area_target_1">北海道・東北</div>
          <div id="area_target_1" class="collapse">
            <div>{{ link_to_route('souvenirs.index', '北海道', ['prefecture' => '北海道'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '青森県', ['prefecture' => '青森県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '岩手県', ['prefecture' => '岩手県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '宮城県', ['prefecture' => '宮城県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '秋田県', ['prefecture' => '秋田県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '山形県', ['prefecture' => '山形県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '福島県', ['prefecture' => '福島県'], ['class' => 'btn btn-light']) }}</div>
          </div>
        </div>
        
        <div id="area2">
          <div id="area_button_2" class="btn btn-light"  data-toggle="collapse" data-target="#area_target_2" aria-expanded="false" aria-controls="area_target_2">関東</div>
          <div id="area_target_2" class="collapse">
            <div>{{ link_to_route('souvenirs.index', '茨城県', ['prefecture' => '茨城県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '栃木県', ['prefecture' => '栃木県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '群馬県', ['prefecture' => '群馬県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '埼玉県', ['prefecture' => '埼玉県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '千葉県', ['prefecture' => '千葉県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '東京都', ['prefecture' => '東京都'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '神奈川県', ['prefecture' => '神奈川県'], ['class' => 'btn btn-light']) }}</div>
          </div>
        </div>
        
        <div id="area3">
          <div id="area_button_3" class="btn btn-light"  data-toggle="collapse" data-target="#area_target_3" aria-expanded="false" aria-controls="area_target_3">中部</div>
          <div id="area_target_3" class="collapse">
            <div>{{ link_to_route('souvenirs.index', '新潟県', ['prefecture' => '新潟県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '富山県', ['prefecture' => '富山県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '石川県', ['prefecture' => '石川県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '福井県', ['prefecture' => '福井県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '山梨県', ['prefecture' => '山梨県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '長野県', ['prefecture' => '長野県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '岐阜県', ['prefecture' => '岐阜県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '静岡県', ['prefecture' => '静岡県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '愛知県', ['prefecture' => '愛知県'], ['class' => 'btn btn-light']) }}</div>
          </div>
        </div>
        
        <div id="area4">
          <div id="area_button_4" class="btn btn-light"  data-toggle="collapse" data-target="#area_target_4" aria-expanded="false" aria-controls="area_target_4">近畿</div>
          <div id="area_target_4" class="collapse">
            <div>{{ link_to_route('souvenirs.index', '三重県', ['prefecture' => '三重県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '滋賀県', ['prefecture' => '滋賀県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '京都府', ['prefecture' => '京都府'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '大阪府', ['prefecture' => '大阪府'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '兵庫県', ['prefecture' => '兵庫県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '奈良県', ['prefecture' => '奈良県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '和歌山県', ['prefecture' => '和歌山県'], ['class' => 'btn btn-light']) }}</div>
          </div>
        </div>
        
        <div id="area5">
          <div id="area_button_5" class="btn btn-light"  data-toggle="collapse" data-target="#area_target_5" aria-expanded="false" aria-controls="area_target_5">中国</div>
          <div id="area_target_5" class="collapse">
            <div>{{ link_to_route('souvenirs.index', '鳥取県', ['prefecture' => '鳥取県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '島根県', ['prefecture' => '島根県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '岡山県', ['prefecture' => '岡山県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '広島県', ['prefecture' => '広島県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '山口県', ['prefecture' => '山口県'], ['class' => 'btn btn-light']) }}</div>
          </div>
        </div>
        
        <div id="area6">
          <div id="area_button_6" class="btn btn-light"  data-toggle="collapse" data-target="#area_target_6" aria-expanded="false" aria-controls="area_target_6">四国</div>
          <div id="area_target_6" class="collapse">
            <div>{{ link_to_route('souvenirs.index', '徳島県', ['prefecture' => '徳島県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '香川県', ['prefecture' => '香川県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '愛媛県', ['prefecture' => '愛媛県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '高知県', ['prefecture' => '高知県'], ['class' => 'btn btn-light']) }}</div>
          </div>
        </div>
        
        <div id="area7">
          <div id="area_button_7" class="btn btn-light"  data-toggle="collapse" data-target="#area_target_7" aria-expanded="false" aria-controls="area_target_7">九州・沖縄</div>
          <div id="area_target_7" class="collapse">
            <div>{{ link_to_route('souvenirs.index', '福岡県', ['prefecture' => '福岡県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '佐賀県', ['prefecture' => '佐賀県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '長崎県', ['prefecture' => '長崎県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '熊本県', ['prefecture' => '熊本県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '大分県', ['prefecture' => '大分県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '宮崎県', ['prefecture' => '宮崎県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '鹿児島県', ['prefecture' => '鹿児島県'], ['class' => 'btn btn-light']) }}</div>
            <div>{{ link_to_route('souvenirs.index', '沖縄県', ['prefecture' => '沖縄県'], ['class' => 'btn btn-light']) }}</div>
          </div>
        </div>
      </div>
      

@endsection