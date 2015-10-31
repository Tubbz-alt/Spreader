var React = require('react');

Spreader.Project = {
    project: {},
    activities: [],
    tasks: [],
    cacheQueryMentions: [],

    init: function(data) {
        this.project = data['project'];
        if (data['activities'] != undefined && data['activities'].length) {
            this.activities = data['activities'];
        }
        if (data['tasks'] != undefined && data['tasks'].length) {
            this.tasks = data['tasks'];
        }

        this.reactRender();
    },

    reactRender: function() {       
        var TasksList = React.createClass({
            render: function() {
                var tasksListNode = this.props.tasks.map(function(task, key) {
                    if (task.activity_id == this.props.activity.id) {
                        var taskLink = Spreader.site_url + '/internal/tasks/' + task.id;
                        var termLink = Spreader.site_url + '/internal/terms/' + task.term_id;
                        var amigoLink = Spreader.site_url + '/internal/amigos/' + task.amigo_id;
                        var userNode = task.amigo_id > 0 ? (
                            <a href={amigoLink}><i className="fa fa-user"></i> {task.amigo_name}</a>
                        ) : (
                            <span><i className="fa fa-user-times"></i> ？？？</span>
                        );
                        var qrcodeUrl = Spreader.site_url + '/app/projects/p' + this.props.activity.project_id + '-a' + task.activity_id + '-t' + task.id + '.jpeg';
                        return (
                            <p><a href={taskLink}>T{task.id}</a> <a href={termLink}><i class="fa fa-flag"></i> {task.term_name}</a> {userNode} <i className="fa fa-money"></i> {task.reward} {task.mission}张 <i className="fa fa-info"></i> {task.description} <a href={qrcodeUrl} target="_blank"><i className="glyphicon glyphicon-qrcode"></i></a></p>
                        );
                    }
                }.bind(this));

                return (
                    <td>
                        {tasksListNode}
                    </td>
                );
            }
        });

        var project = this.project, ActivityForm = React.createClass({
            getInitialState: function() {
                return {
                    action: 'touch',
                    activity: null,
                    tasks: [],
                    errors: {}
                };
            },

            componentDidMount: function() {
                this.textareaAtwho();
            },

            componentDidUpdate: function() {
                this.textareaAtwho();
            },

            textareaAtwho: function() {
                var cachequeryMentions = [], itemsMentions,
                    searchMentions = $('textarea[name="tasks_template"]').atwho({
                    at: "#",
                    displayTpl: "<li>${name}</li>",
                    callbacks: {
                        remoteFilter: function(query, render_view) {
                            var thisVal = query,
                            self = $(this);
                            if (!self.data('active') && thisVal.length >= 2) {
                                self.data('active', true);
                                itemsMentions = cachequeryMentions[thisVal];
                                if (typeof itemsMentions == "object") {
                                    render_view(itemsMentions);
                                } else {
                                    if (self.xhr) {
                                        self.xhr.abort();
                                    }
                                    self.xhr = $.getJSON(Spreader.site_url+"/internal/terms/getTerms", {s: thisVal}, function(data) {
                                        cachequeryMentions[thisVal] = data;
                                        render_view(data);
                                    });
                                }
                                self.data('active', false);
                            }
                        }
                    }
                }).atwho({
                    at: "@",
                    displayTpl: "<li><i class='glyphicon glyphicon-user'></i> ${name} <span><i class='grade-${grade} fa fa-heart text-danger'></i><i class='grade-${grade} fa fa-heart text-danger'></i><i class='grade-${grade} fa fa-heart text-danger'></i><i class='grade-${grade} fa fa-heart text-danger'></i><i class='grade-${grade} fa fa-heart text-danger'></i></span> ${evaluate}</li>",
                    callbacks: {
                        remoteFilter: function(query, render_view) {
                            var thisVal = query,
                            self = $(this);
                            if (!self.data('active') && thisVal.length >= 2) {
                                self.data('active', true);
                                itemsMentions = cachequeryMentions[thisVal];
                                if (typeof itemsMentions == "object") {
                                    render_view(itemsMentions);
                                } else {
                                    if (self.xhr) {
                                        self.xhr.abort();
                                    }
                                    self.xhr = $.getJSON(Spreader.site_url+"/internal/amigos/getAmigos", {s: thisVal}, function(data) {
                                        cachequeryMentions[thisVal] = data;
                                        render_view(data);
                                    });
                                }
                                self.data('active', false);
                            }
                        }
                    }
                });
            },

            handleClick: function() {
                $.ajax({
                    url: Spreader.site_url + '/internal/projects/' + project.id + '/activities',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        deadline: this.refs.deadline.getDOMNode().value,
                        tasks_template: this.refs.tasks_template.getDOMNode().value
                    },
                    beforeSend: function(request) {
                        request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                    },
                    success: function(res) {
                        if (res['status'] != undefined && res['status'] == 'ok') {
                            this.setState({action: 'mv', activity: res['activity'], tasks: res['tasks']});
                        } else {
                            this.setState({errors: res});
                        }
                    }.bind(this)
                });
            },
    
            handleClickUpdate: function() {
                $.ajax({
                    url: Spreader.site_url + '/internal/projects/' + project.id + '/activities/' + this.props.activity.id,
                    method: 'PUT',
                    dataType: 'json',
                    data: {
                        deadline: this.refs.deadline.getDOMNode().value,
                        tasks_template: this.refs.tasks_template.getDOMNode().value
                    },
                    beforeSend: function(request) {
                        request.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                    },
                    success: function(res) {
                        if (res['status'] != undefined && res['status'] == 'ok') {
                            this.setState({action: 'mv', activity: res['activity'], tasks: res['tasks']});
                        } else {
                            this.setState({errors: res});
                        }
                    }.bind(this)
                });
            },

            handleClickRemove: function() {
                this.setState({action: 'rm'});        
            },

            handleClickCancel: function() {
                this.setState({action: 'cancel'}); 
            },

            render: function() {
                var deadlineError = this.state.errors.deadline == undefined ? '' : 'has-error';
                var tasksTemplateError = this.state.errors.tasks_template == undefined ? '' : 'has-error';
                var activity = this.props.activity;

                switch (this.state.action) {
                    case 'mv': return (
                        <ActivityRow activity={this.state.activity} tasks={this.state.tasks} />
                    );

                    case 'cancel': return (
                        <ActivityRow activity={activity} tasks={this.props.tasks} />
                    );

                    case 'rm': return null;

                    default: return activity.id > 0 ? (
                        <tr>
                            <th>T{activity.id}</th>
                            <td className={deadlineError}><input type="text" name="deadline" ref="deadline" className="form-control input-sm form-error" value={activity.deadline} data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" /><p className="help-block">{this.state.errors.deadline}</p></td>
                            <td className={tasksTemplateError}><textarea id="" name="tasks_template" ref="tasks_template" cols="30" rows="5" className="form-control input-sm" placeholder="#场景 @人员 $报酬 =传单数 任务描述">{activity.tasks_template}</textarea><p className="help-block">{this.state.errors.tasks_template}</p></td>
                            <td>New</td>
                            <td><a onClick={this.handleClickUpdate} href="#">更新</a><br/><a className="text-danger" onClick={this.handleClickCancel} href="#">取消</a></td>
                        </tr>
                    ) : (
                        <tr>
                            <th>[auto]</th>
                            <td className={deadlineError}><input type="text" name="deadline" ref="deadline" className="form-control input-sm form-error" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" /><p className="help-block">{this.state.errors.deadline}</p></td>
                            <td className={tasksTemplateError}><textarea id="" name="tasks_template" ref="tasks_template" cols="30" rows="5" className="form-control input-sm" placeholder="#场景 @人员 $报酬 =传单数 任务描述"></textarea><p className="help-block">{this.state.errors.tasks_template}</p></td>
                            <td>New</td>
                            <td><a onClick={this.handleClick} href="#">保存</a><br/><a className="text-danger" onClick={this.handleClickRemove} href="#">移除</a></td>
                        </tr>
                    );
                }
            }
        });

        var ActivityRow = React.createClass({
            getInitialState: function() {
                return  {actionEdit: false}
            },
        
            handleClick: function() {
                this.setState({actionEdit: true});
            },

            render: function() {
                var activity = this.props.activity;
                if (activity.id == 0 || this.state.actionEdit) {
                    return (
                        <ActivityForm activity={activity} tasks={tasks} />
                    );
                }
                return (
                    <tr>
                        <th>A{activity.id}</th>
                        <td>{activity.deadline}</td>
                        <TasksList activity={activity} tasks={this.props.tasks} />
                        <td>{activity.status}</td>
                        <td><a onClick={this.handleClick} href="#">修改</a></td>
                    </tr>
                );
            }
        });

        var activities = this.activities, tasks = this.tasks, ActivitiesList = React.createClass({
            getInitialState: function() {
                return {
                    activities: activities,
                };
            },

            handleClickAdd: function() {
                this.setState({activities: this.state.activities.concat([{id: 0}])});
            },

            render: function() {
                var activityNodes = this.state.activities.map(function(activity, key) {
                    return (
                        <ActivityRow activity={activity} tasks={tasks} />
                    );
                });

                return (
                    <form action="" method="POST">
                        <table className="table table-striped">
                            <thead>
                                <tr>
                                    <th className="col-10-10"><a href="javascript:;" onClick={this.handleClickAdd}><i className="glyphicon glyphicon-plus"></i> 活动</a></th>
                                    <th className="col-10-10">活动截止时间</th>
                                    <th>#场景 @人员 $报酬 =传单数</th>
                                    <th className="col-10-10">状态</th>
                                    <th className="col-10-10">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                {activityNodes}
                            </tbody>
                        </table>
                    </form>
                );
            }
        });

        React.render(
            <ActivitiesList />,
            document.getElementById('activities-container')
        );
    }
}
