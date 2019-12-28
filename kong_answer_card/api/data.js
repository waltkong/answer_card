var base_req_url = "http://local.answer.com/api/";

export function subject_list(query){
    return uni.request({
        url: base_req_url + "wk/subject_list",
        data: query,
        header: {
            'token': 'wk' //自定义请求头信息
        }
    });
}

export function exam_list(query){
    return uni.request({
        url: base_req_url + "wk/exam_list",
        data: query,
        header: {
            'token': 'wk' //自定义请求头信息
        }
    });
}

export function exam_info(query){
    return uni.request({
        url: base_req_url + "wk/exam_info",
        data: query,
        header: {
            'token': 'wk' //自定义请求头信息
        }
    });
}


export function each_question(query){
    return uni.request({
        url: base_req_url + "wk/each_question",
        data: query,
        header: {
            'token': 'wk' //自定义请求头信息
        }
    });
}

export function do_answer(query){
    return uni.request({
        url: base_req_url + "wk/do_answer",
        data: query,
        header: {
            'token': 'wk' //自定义请求头信息
        }
    });
}


export function total_score(query){
    return uni.request({
        url: base_req_url + "wk/total_score",
        data: query,
        header: {
            'token': 'wk' //自定义请求头信息
        }
    });
}

export function do_like(query){
    return uni.request({
        url: base_req_url + "wk/do_like",
        data: query,
        header: {
            'token': 'wk' //自定义请求头信息
        }
    });
}

export function do_history(query){
    return uni.request({
        url: base_req_url + "wk/do_history",
        data: query,
        header: {
            'token': 'wk' //自定义请求头信息
        }
    });
}

