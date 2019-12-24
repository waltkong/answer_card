define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'wk_exam_question/index' + location.search,
                    add_url: 'wk_exam_question/add',
                    edit_url: 'wk_exam_question/edit',
                    del_url: 'wk_exam_question/del',
                    multi_url: 'wk_exam_question/multi',
                    table: 'wk_exam_question',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'exam_id', title: __('Exam_id')},
                        {field: 'score', title: __('Score')},
                        {field: 'name', title: __('Name')},
                        {field: 'question_type', title: __('Question_type')},
                        {field: 'question_index', title: __('Question_index')},
                        {field: 'click_count', title: __('Click_count')},
                        {field: 'dislike_count', title: __('Dislike_count')},
                        {field: 'import_count', title: __('Import_count')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'like_count', title: __('Like_count')},
                        {field: 'wkexam.id', title: __('Wkexam.id')},
                        {field: 'wkexam.subject_id', title: __('Wkexam.subject_id')},
                        {field: 'wkexam.name', title: __('Wkexam.name')},
                        {field: 'wkexam.school', title: __('Wkexam.school')},
                        {field: 'wkexam.author', title: __('Wkexam.author')},
                        {field: 'wkexam.icon_image', title: __('Wkexam.icon_image'), events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'wkexam.sort', title: __('Wkexam.sort')},
                        {field: 'wkexam.total_score', title: __('Wkexam.total_score')},
                        {field: 'wkexam.click_count', title: __('Wkexam.click_count')},
                        {field: 'wkexam.like_count', title: __('Wkexam.like_count')},
                        {field: 'wkexam.createtime', title: __('Wkexam.createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'wkexam.updatetime', title: __('Wkexam.updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'wkexam.deletetime', title: __('Wkexam.deletetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        recyclebin: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    'dragsort_url': ''
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: 'wk_exam_question/recyclebin' + location.search,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'name', title: __('Name'), align: 'left'},
                        {
                            field: 'deletetime',
                            title: __('Deletetime'),
                            operate: 'RANGE',
                            addclass: 'datetimerange',
                            formatter: Table.api.formatter.datetime
                        },
                        {
                            field: 'operate',
                            width: '130px',
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'Restore',
                                    text: __('Restore'),
                                    classname: 'btn btn-xs btn-info btn-ajax btn-restoreit',
                                    icon: 'fa fa-rotate-left',
                                    url: 'wk_exam_question/restore',
                                    refresh: true
                                },
                                {
                                    name: 'Destroy',
                                    text: __('Destroy'),
                                    classname: 'btn btn-xs btn-danger btn-ajax btn-destroyit',
                                    icon: 'fa fa-times',
                                    url: 'wk_exam_question/destroy',
                                    refresh: true
                                }
                            ],
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});