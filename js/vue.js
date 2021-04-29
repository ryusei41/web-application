var app = new Vue({
  el: '#app',
  data: {
    geoActive: false, //現在地が有効かどうか
    getting: true, // 取得中アイコン
    keyword: '', // キーワード
    lat: '', // 緯度
    lng: '', // 経度
    range: '', // 範囲
    genre: '',//ジャンル
    gourmetCount: 0, // 検索件数
    gourmetList: [], // 検索結果
  },
  methods: {
    //現在地を取得
    getGeo: function (e) {
      e.preventDefault();

      if (navigator.geolocation) {
        let $this = this;
        navigator.geolocation.getCurrentPosition(function (position) {
          $this.geoActive = true;
          $this.lat = position.coords.latitude, // 緯度
            $this.lng = position.coords.longitude; // 経度
          let n = 6;
          $this.lat = Math.floor($this.lat * Math.pow(10, n)) / Math.pow(10, n);
          $this.lng = Math.floor($this.lng * Math.pow(10, n)) / Math.pow(10, n);
          console.log($this.lat, $this.lng);
          $this.getGourmet($this.lat, $this.lng, $this.range, $this.keyword, $this.genre);
        }, function (error) {
          if (error.code == 1) {
            alert("位置情報取得が許可されていません。");
          } else if (error.code == 2) {
            alert("位置情報取得に失敗しました。");
          } else {
            alert("タイムアウトしました。");
          }
        });
      } else {
        alert("この端末では位置情報取得ができません。");
      }
    },
    //ジャンル選択 
    getgenre: function (value) {
      let $this = this;
      $this.genre = value;
      $this.getGourmet($this.lat, $this.lng, $this.range, $this.keyword, $this.genre);
    },
    //入力・出力
    getGourmet: function () {
      this.getting = false;
      const params = new URLSearchParams();
      params.append('keyword', this.keyword);
      params.append('lat', this.lat);
      params.append('lng', this.lng);
      params.append('range', this.range);
      params.append('genre', this.genre);
      let $this = this;
      axios.post('main.php', params).then(function (response) { // 成功時
        $this.getting = true;
        $this.gourmetList = [];

        let result = response.data.results;
        $this.gourmetCount = (result.results_available > 100) ? 100 : result.results_available;
        let shops = result.shop;
        i = +1;
        console.log(shops, $this.gourmetCount, i, $this.lat, $this.lng, $this.range);
        if ($this.gourmetCount > 0) {
          if (i == 1) {
            document.getElementById("genre").scrollIntoView(true);
          }
        }
        for (let shop of shops) {
          $this.gourmetList.push({
            name: shop.name, // 店名
            category: shop.genre.name, // カテゴリ
            subcategory: shop.sub_genre.name, //サブカテゴリ 
            photo: shop.photo.pc.l, // メイン画像
            access: shop.mobile_access, // アクセス
            open: shop.open, // 営業時間
            average: shop.budget.average, // 平均予算
            shop_url: 'detail.php?id=' + encodeURI(shop.id)//店舗詳細ページURL
          })
        }
      }).catch(function (error) { // 失敗時
        $this.getting = true;
        $this.message = error;
      })
    }
  }

})

