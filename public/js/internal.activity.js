(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

Spreader.Activity = {
    activity: {},
    tasks: [],

    init: function init(data) {
        this.activity = data['activity'];
        if (data['tasks'] != undefined && data['tasks'].length) {
            this.tasks = data['tasks'];
        }

        this.reactRender();
    },

    reactRender: function reactRender() {
        var activity = this.activity,
            TaskForm = React.createClass({
            displayName: 'TaskForm',

            getInitialState: function getInitialState() {
                return {
                    action: 'touch',
                    task: null,
                    errors: {}
                };
            },

            handleClick: function handleClick() {
                $.ajax({
                    url: Spreader.site_url + '/internal/activities/' + activity.id + '/tasks',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        deadline: this.refs.deadline.getDOMNode().value,
                        background: this.refs.background.getDOMNode().value
                    },
                    beforeSend: function beforeSend(request) {
                        request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                    },

                    success: (function (res) {
                        if (res['status'] != undefined && res['status'] == 'ok') {
                            this.setState({ action: 'mv', task: res['task'] });
                        } else {
                            this.setState({ errors: res });
                        }
                    }).bind(this)
                });
            },

            handleClickRemove: function handleClickRemove() {
                this.setState({ action: 'rm' });
            },

            render: function render() {
                var deadlineError = this.state.errors.deadline == undefined ? '' : 'has-error';
                var backgroundError = this.state.errors.background == undefined ? '' : 'has-error';
                switch (this.state.action) {
                    case 'mv':
                        return '';

                    case 'rm':
                        return null;

                    default:
                        return React.createElement(
                            'tr',
                            null,
                            React.createElement(
                                'th',
                                null,
                                '#000'
                            ),
                            React.createElement(
                                'td',
                                { className: deadlineError },
                                React.createElement('input', { type: 'text', name: 'deadline', ref: 'deadline', className: 'form-control input-sm form-error', 'data-provide': 'datepicker', 'data-date-format': 'mm/dd/yyyy' }),
                                React.createElement(
                                    'p',
                                    { className: 'help-block' },
                                    this.state.errors.deadline
                                )
                            ),
                            React.createElement(
                                'td',
                                { className: backgroundError },
                                React.createElement('textarea', { id: '', name: 'background', ref: 'background', cols: '30', rows: '5', className: 'form-control input-sm' }),
                                React.createElement(
                                    'p',
                                    { className: 'help-block' },
                                    this.state.errors.background
                                )
                            ),
                            React.createElement(
                                'td',
                                null,
                                React.createElement('input', { type: 'checkbox', name: 'qrcode', value: '1', className: 'form-control input-sm' })
                            ),
                            React.createElement(
                                'td',
                                null,
                                'New'
                            ),
                            React.createElement(
                                'td',
                                null,
                                React.createElement(
                                    'a',
                                    { onClick: this.handleClick, href: '#' },
                                    '保存'
                                ),
                                React.createElement('br', null),
                                React.createElement(
                                    'a',
                                    { className: 'text-danger', onClick: this.handleClickRemove, href: '#' },
                                    '移除'
                                )
                            )
                        );
                }
            }
        });

        var tasks = this.tasks,
            TasksList = React.createClass({
            displayName: 'TasksList',

            getInitialState: function getInitialState() {
                return {
                    tasks: tasks,
                    action: false
                };
            },

            handleClickAdd: function handleClickAdd() {
                this.setState({ tasks: [{ id: 0 }].concat(this.state.tasks) });
            },

            render: function render() {
                var taskNodes = this.state.tasks.map(function (task) {
                    if (task.id == 0) {
                        return React.createElement(TaskForm, null);
                    }
                    return React.createElement(
                        'tr',
                        null,
                        React.createElement(
                            'th',
                            null,
                            task.id
                        ),
                        React.createElement(
                            'td',
                            null,
                            task.created_at
                        ),
                        React.createElement(
                            'td',
                            null,
                            task.created_at
                        ),
                        React.createElement(
                            'td',
                            null,
                            task.created_at
                        ),
                        React.createElement(
                            'td',
                            null,
                            task.created_at
                        ),
                        React.createElement(
                            'td',
                            null,
                            task.created_at
                        )
                    );
                });

                return React.createElement(
                    'form',
                    { action: '', method: 'POST' },
                    React.createElement(
                        'table',
                        { className: 'table table-striped' },
                        React.createElement(
                            'thead',
                            null,
                            React.createElement(
                                'tr',
                                null,
                                React.createElement(
                                    'th',
                                    { className: 'col-10-10' },
                                    React.createElement(
                                        'a',
                                        { href: 'javascript:;', onClick: this.handleClickAdd },
                                        React.createElement('i', { className: 'glyphicon glyphicon-plus' }),
                                        ' 任务'
                                    )
                                ),
                                React.createElement(
                                    'th',
                                    { className: 'col-10-10' },
                                    '执行时间'
                                ),
                                React.createElement(
                                    'th',
                                    null,
                                    '#场景 @人员'
                                ),
                                React.createElement(
                                    'th',
                                    { className: 'col-10-10' },
                                    '统一码？'
                                ),
                                React.createElement(
                                    'th',
                                    { className: 'col-10-10' },
                                    '状态'
                                ),
                                React.createElement(
                                    'th',
                                    { className: 'col-10-10' },
                                    '操作'
                                )
                            )
                        ),
                        React.createElement(
                            'tbody',
                            null,
                            taskNodes
                        )
                    )
                );
            }
        });

        React.render(React.createElement(TasksList, null), document.getElementById('tasks-container'));
    }
};

},{}]},{},[1]);
