//app.js
App({
  d: {
    hostUrl: 'https://console.wanjingshangbiao.com/v1',
  },
  onLaunch: function () {
    var that = this
    var user = wx.getStorageSync('user') || {};
    var userInfo = wx.getStorageSync('userInfo') || {};
    if ((!user.openid || (user.expires_in || Date.now()) < (Date.now() + 600)) && (!userInfo.nickName)) {
      wx.login({
        success: function (res) {
          if (res.code) {
            wx.getUserInfo({
              success: function (res) {
                var objz = {};
                objz.avatarUrl = res.userInfo.avatarUrl;
                objz.nickName = res.userInfo.nickName;
                objz.gender  = res.userInfo.gender;
                objz.nickName = res.userInfo.nickName;

                console.log(objz);
                //console.log(objz);  
                wx.setStorageSync('userInfo', objz);//存储userInfo  
              }
            });
            var d = that.globalData;//这里存储了appid、secret、token串    
            var l = 'https://api.weixin.qq.com/sns/jscode2session?appid=' + d.appid + '&secret=' + d.secret + '&js_code=' + res.code + '&grant_type=authorization_code';
            wx.request({
              url: l,
              data: {},
              method: 'GET', // OPTIONS, GET, HEAD, POST, PUT, DELETE, TRACE, CONNECT    
              // header: {}, // 设置请求的 header    
              success: function (res) {
                console.log(res.data);
                var obj = {};
                obj.openid = res.data.openid;
                obj.expires_in = Date.now() + res.data.expires_in;
                //console.log(obj);  
                wx.setStorageSync('user', obj);//存储openid    
              }
            });
          } else {
            console.log('获取用户登录态失败！' + res.errMsg)
          }
        }
      });
    }
  },
  globalData: {
    appid: 'wx009ec83a43370e72',
    secret: '87a5e9540c1671b12d29d399eb161391',
  }
})