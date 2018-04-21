//index.js
//获取应用实例
const app = getApp()

Page({
  data: {
    imgUrls: [],
    indicatorDots: true,
    autoplay: true,
    interval: 3000,
    duration: 500,
    markers: [{
      iconPath: "../../images/mark_ditu.png",
      id: 0,
      latitude: 45.7440900000,
      longitude: 126.6858500000,
      width: 25,
      height: 25
    }],
    animate: "",
    Product:[]
  },
  
  onLoad: function () {
    var that = this;
    // 幻灯片异步数据
    wx.request({
      url: app.d.hostUrl + '/banner/index',
      method: 'get',
      header: {
        'content-type': 'application/json'
      },  
      success: function (res) {
        var data = res.data,imgUrls = [];
        for (var i = 0; i < data.length; i++) {
          imgUrls.push(data[i].https_url);
        }
        console.log(imgUrls);
        that.setData({
          imgUrls: imgUrls
        });
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
    // 服务项目异步数据
    wx.request({
      url: app.d.hostUrl + '/product/index',
      data: { pageSize: 4, type: "",page:1},
      method: 'get',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        var data = res.data.list, Product = [];
        for (var i = 0; i < data.length; i++) {
          Product.push(data[i]);
        }
        that.setData({
          Product: Product
        });
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常,请重新打开！',
          duration: 2000
        });
      },
    })
    // 案例展示
    wx.request({
      url: app.d.hostUrl + '/case/index',
      data: { pageSize: 4, type: "", page: 1 },
      method: 'get',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        var data = res.data.list, Case = [];
        for (var i = 0; i < data.length; i++) {
          Case.push(data[i]);
        }
        that.setData({
          Case: Case
        });
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常,请重新打开！',
          duration: 2000
        });
      },
    })
    //新闻中心
    wx.request({
      url: app.d.hostUrl + '/article/index',
      data: { pageSize: 2, type: "", page: 1 },
      method: 'get',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        var data = res.data.list, article = [];
        for (var i = 0; i < data.length; i++) {
          article.push(data[i]);
        }
        that.setData({
          article: article
        });
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常,请重新打开！',
          duration: 2000
        });
      },
    })
    // 联系我们
    wx.request({
      url: app.d.hostUrl + '/default/information',
      method: 'get',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        var data = res.data;
        console.log(data);
        var tel = data.telephone;
        var place = data.address;
        that.setData({
          tel: tel,
          place: place,
        });
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常！',
          duration: 2000
        });
      },
    })
  },

  TypeLink_Tap: function(){
    var that = this;
    that.setData({
      animate: "animate"
    })
  },

  Disk_Tap: function () {
    var that = this;
    that.setData({
      animate: ""
    })
  },

  Tel: function(){
    wx.makePhoneCall({
      phoneNumber: '400-901-0775', //此号码并非真实电话号码，仅用于测试  
      success: function () {
        console.log("拨打电话成功！")
      },
      fail: function () {
        console.log("拨打电话失败！")
      }
    })  
  },

  formSubmit: function (e) {
    // console.log('form发生了submit事件，携带数据为：', e.detail.value);
    var tel = e.detail.value.tel,
      email = e.detail.value.email,
      message = e.detail.value.message,
      that = this;
    if (tel != "" && email != "" && message != ""){
      wx.request({
        url: app.d.hostUrl + '/default/message-panel',
        data: {
          email: email,
          tel: tel,
          message: message
        },
        method: 'POST',
        header: {
          'content-type': 'application/x-www-form-urlencoded'
        },
        success: function (res) {

          wx.showToast({
            title: '提交成功！',
            icon: 'success',
            duration: 2000
          });

          that.setData({
            form_info: ''
          })  
        },
        fail: function (e) {
          wx.showToast({
            title: '网络异常,请重新提交！',
            icon: 'none',
            duration: 2000
          });
        },
      })
    }else{
      wx.showToast({
        title: '请填写完整表格！',
        icon: 'none',
        duration: 2000
      });
    }
    
  },

  ProductClick: function(e){
    var dataset = e.currentTarget.dataset;
    wx.navigateTo({
      url: '../service/servicedetail/servicedetail' + '?Id=' + dataset.id
    })
  },

  NewsClick: function (e) {
    var dataset = e.currentTarget.dataset;
    wx.navigateTo({
      url: '../news/newsdetail/newsdetail' + '?Id=' + dataset.id
    })
  }

})
