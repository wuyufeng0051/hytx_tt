// pages/infomation/infomation.js
const app = getApp()

Page({

  /**
   * 页面的初始数据
   */
  data: {
    sex:[]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    var user = wx.getStorageSync('Ontime_user');
    var data = {
       avatarUrl : user.avatarUrl,
       nickName : user.nickName,
       gender : user.gender,
       telephone : user.telephone,
       description : user.description,
       address : user.address
    };
    
    console.log(user);
    that.setData(
      data
    );
  },

  radioChange: function (e) {
    var that = this;
    that.setData({
      sex: e.detail.value
    })
    // console.log(e.detail.value)
  },  

  formSubmit: function (e) {
    var that   = this;
    var user   = wx.getStorageSync('user');
    var tel    = e.detail.value.tel,
        openid = user.openid,
        name   = e.detail.value.name,
        sex    = that.data.sex,
        place  = e.detail.value.place,
        info   = e.detail.value.info;

    if (tel != "" && name != "") {
      wx.request({
        url: app.d.hostUrl + '/user/update',
        data: {
          step:2,
          openid: openid,
          nickName: name,
          telephone: tel,
          gender: sex,
          address: place,
          description: info
        },
        method: 'PUT',
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
    } else {
      wx.showToast({
        title: '请填写姓名和电话！',
        icon: 'none',
        duration: 2000
      });
    }
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
    let pages = getCurrentPages();

    if (pages.length > 1) {

      let prevPage = pages[pages.length - 2]; //上一个页面

      if (prevPage.getUser) {

        prevPage.getUser();//刷新A页面数据

      }

    }
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