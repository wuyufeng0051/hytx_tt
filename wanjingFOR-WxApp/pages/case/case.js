// pages/case/case.js

const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    scrollLeft: 0, //tab标题的滚动条位置
    currentTab: 0,
    NavList: [],
    ServiceList: [],
    page: 1,
    isload: false,
    isend: false,
    typeid: "",
    show: [],
    load_show: []

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    that.LoadNav();
    that.Loadservice('', 0);
  },

  LoadNav: function () {
    var that = this;
    wx.request({
      url: app.d.hostUrl + '/case/type',
      method: 'get',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        var data = res.data, NavList = [], typeid = [];
        for (var i = 0; i < data.length; i++) {
          NavList.push(data[i]);
        }
        console.log(NavList);
        that.setData({
          NavList: NavList
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

  // 上拉加载
  lower: function () {

    console.log(111)
    // 页面上拉触底事件的处理函数
    var that = this, isload = that.data.isload, isend = that.data.isend, typeid = that.data.typeid;
    (that.data.page)++;
    if (!isload && !isend) {
      that.Loadservice(typeid, that.data.page);
    }
  },

  Loadservice: function (id, page) {
    var that = this;
    that.setData({
      isload: true,
      load_show: " on"
    })
    wx.request({
      url: app.d.hostUrl + '/case/index',
      data: {
        type: id,
        page: page,
        pageSize: 5
      },
      method: 'get',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        var data = res.data.list, ServiceList = [], pageCount = res.data.pageInfo.pageCount;
        console.log(pageCount)
        for (var i = 0; i < data.length; i++) {
          that.data.ServiceList.push(data[i]);
        }
        that.data.load_show = "";
        if (page == pageCount) {
          that.data.isend = true;
          that.data.show = " on";
        }
        that.setData({
          ServiceList: that.data.ServiceList,
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

  // 点击标题切换当前页时改变样式
  swichNav: function (e) {
    var cur = e.target.dataset.current;
    var typeid = e.target.dataset.typeid;
    var that = this;
    that.data.ServiceList = [];
    that.data.isend = false;
    that.data.show = "";
    that.data.page = 1;
    that.data.typeid = typeid;
    that.Loadservice(typeid, 1);
    that.setData({
      currentTab: cur,
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