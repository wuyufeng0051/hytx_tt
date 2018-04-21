// pages/my/my.js
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    pic:[],
    name:[],
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    that.SubmitUserInfo();
    that.getUser();
    
  },

  getUser: function(){
    var that = this;
    var user = wx.getStorageSync('user');
    var openid = user.openid;

    // 异步获取用户信息
    wx.request({
      url: app.d.hostUrl + '/user/view',
      data: { openid: openid },
      method: 'get',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        var data = res.data.data, Product = [];
        var Ontime_user = {};
        Ontime_user.avatarUrl = data.avatarUrl;
        Ontime_user.nickName = data.nickName;
        Ontime_user.address = data.address;
        Ontime_user.description = data.description;
        Ontime_user.gender = data.gender;
        Ontime_user.telephone = data.telephone;

        wx.setStorageSync('Ontime_user', Ontime_user);
        that.setData({
          name: data.nickName,
          pic: data.avatarUrl
        });
      },
      fail: function (e) {
        wx.showToast({
          title: '网络异常,请重新打开！',
          duration: 2000
        });
      },
    })
  },

  SameTap: function(){
    var that = this;
    wx.getUserInfo({
      success: function (res) {
        var userInfo = res.userInfo;
        var nickName = userInfo.nickName;
        var avatarUrl = userInfo.avatarUrl;
        var gender = userInfo.gender; //性别 0：未知、1：男、2：女
        
        var user = wx.getStorageSync('user');
        var openid = user.openid;
        var Ontime_user = {};
        
        wx.request({
          url: app.d.hostUrl + '/user/update',
          data: { openid: openid, step: 1, nickName: nickName, avatarUrl: avatarUrl, gender: gender},
          method: 'PUT',
          header: {
            'content-type': 'application/x-www-form-urlencoded'
          },
          success: function (res) {
            
            if (res.data.state == 200){
              wx.setStorageSync('Ontime_user', Ontime_user);
              
              Ontime_user.avatarUrl = avatarUrl;
              Ontime_user.nickName = nickName;
              Ontime_user.gender = gender;
              Ontime_user.address = "";
              Ontime_user.telephone = "";
              Ontime_user.description = "";
              wx.setStorageSync('Ontime_user', Ontime_user);

              that.setData({
                name: nickName,
                pic: avatarUrl
              });
              wx.showToast({
                title: '同步成功！',
                duration: 2000
              });
            }else{
              wx.showToast({
                title: '网络异常111！',
                duration: 2000
              });
            }
          },
          fail: function (e) {
            wx.showToast({
              title: '网络异常！',
              duration: 2000
            });
          },
        })
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

  SubmitUserInfo: function () {
    var user = wx.getStorageSync('user');
    var userInfo = wx.getStorageSync('userInfo');

    var openid = user.openid;
    var avatarUrl = userInfo.avatarUrl;
    var gender = userInfo.gender;
    var nickName = userInfo.nickName;

    wx.request({
      url: app.d.hostUrl + '/user/login',
      data: {
        openid: openid,
        avatarUrl: avatarUrl,
        gender: gender,
        nickName: nickName
      },
      method: 'POST',
      header: {
        'content-type': 'application/x-www-form-urlencoded'
      },
      success: function () {
        console.log("发送openid成功！");
      },
      fail: function (e) {

      },
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