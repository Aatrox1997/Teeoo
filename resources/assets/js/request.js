import axios from 'axios';
import Cookies from 'js-cookie';

const service = axios.create({
    timeout: 15000 // 请求超时时间
})

// request拦截器
service.interceptors.request.use(config => {
    if (localStorage.getItem('token')) {
        config.headers['authorization'] = "Bearer " + localStorage.getItem('token');
    }
    return config
}, error => {
    console.log(error)
    Promise.reject(error)
})

// respone拦截器
service.interceptors.response.use(
    response => {
        const res = response.data;
        //0 获取数据成功 1 修改成功 2 添加成功 3删除成功
        if (res.code === 0 || res.code === 1 || res.code === 2 || res.code === 3) {
            if (res.code !== 0) {  // 获取数据成功就不显示消息弹出
            }
            return response.data;
        } else {
            alert(res.msg);
            return Promise.reject('error')
        }
    },
    error => {
        return Promise.reject(error)
    }
)

export default service