// pages/news/newsdetail/newsdetail.js
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    markers: [{
      iconPath: "../../images/mark_ditu.png",
      id: 0,
      latitude: 45.7440900000,
      longitude: 126.6858500000,
      width: 25,
      height: 25
    }],
    animate: "",

  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
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
  Tel: function () {
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