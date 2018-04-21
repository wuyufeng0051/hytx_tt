// pages/news/news.js
const app = getApp();


Page({

  /**
   * 页面的初始数据
   */
  data: {
    isload: false,
    isend: false,
    newsList: [],
    page: 1,
    show: [],
    load_show: []
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    that.LoadNews(1);
  },
  // 上拉加载
  lower: function () {

    console.log(111)
    // 页面上拉触底事件的处理函数
    var that = this, isload = that.data.isload, isend = that.data.isend, typeid = that.data.typeid;
    (that.data.page)++;
    if (!isload && !isend) {
      that.LoadNews(that.data.page);
    }
  },

  LoadNews: function (page) {
    var that = this;
    that.setData({
      isload: true,
      load_show: " on"
    })
    wx.request({
      url: app.d.hostUrl + '/article/index',
      data: {
        // type: id,
        page: page,
        pageSize: 5
      },
      method: 'get',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        var data = res.data.list, newsList = [], pageCount = res.data.pageInfo.pageCount;
        console.log(pageCount)
        for (var i = 0; i < data.length; i++) {
          that.data.newsList.push(data[i]);
        }
        that.data.load_show = "";
        if (page == pageCount) {
          that.data.isend = true;
          that.data.show = " on";
        }
        that.setData({
          newsList: that.data.newsList,
          isload: false,
          show: that.data.show,
          load_show: that.data.load_show
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

  TypeLink_Tap: function () {
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

  LinkClick: function (e) {
    //dataset内包含data-*的数据
    var dataset = e.currentTarget.dataset;
    wx.navigateTo({
      url: '../news/newsdetail/newsdetail' + '?Id=' + dataset.id
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
  
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
  
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {
  
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {
  
  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
  
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
  
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  
  }
})