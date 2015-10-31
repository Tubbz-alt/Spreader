var React = require('react');
var HightCharts = require('react-highcharts/dist/bundle/highcharts');

Spreader.Dashboard = {
    config: {},

    init: function(data) {
        this.config = data['config'];

        this.reactRender();
    },

    reactRender: function() {
        var config = this.config, ChartBuilding = React.createClass({
            getInitialState: function() {
                return {config: config};
            },

            handleClick: function(event) {
                var day = $(event.target).data('day'), data = {};
                if (day == 0) {
                    var startDay = $('#startDay').val(), endDay = $('#endDay').val();
                    if (startDay == "" || endDay == "") {
                        $(event.target).addClass('btn-danger');
                        return false;
                    }
                    data['start_day'] = startDay;
                    data['end_day'] = endDay;
                } else {
                    data['period_day'] = day;
                }
                data['activity_filter'] = $('#activityFilter').val();

                $('.chart-filter .btn-primary, .chart-filter .btn-danger').removeClass('btn-primary').removeClass('btn-danger');
                $(event.target).addClass('btn-primary');
                $.getJSON(Spreader.site_url+"/analytics/dashboard/hightcharts", data, function(data) {
                    this.setState({config: data});
                }.bind(this));
            },

            render: function() {
                return (
                    <div>
                        <div className="row">
                            <div className="col-md-8">
                                <div className="input-group chart-filter">
                                    <span className="input-group-btn">
                                        <button className="btn btn-default btn-primary" onClick={this.handleClick} data-day="-7">7天</button>
                                        <button className="btn btn-default" onClick={this.handleClick} data-day="-14">14天</button>
                                        <button className="btn btn-default" onClick={this.handleClick} data-day="-30">30天</button>
                                    </span>
                                    <input id="startDay" className="form-control col-10-10 no-border-right" type="text" placeholder="起始时间" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" />
                                    <input id="endDay" className="form-control col-10-10" type="text" placeholder="截止时间" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" />
                                    <span className="input-group-btn pull-left">
                                        <button className="btn btn-default" type="button" onClick={this.handleClick} data-day="0"><i className="fa fa-filter"></i> Filter</button>
                                    </span>
                                </div>
                            </div>
                            <div className="col-md-4">
                                <input id="activityFilter" className="form-control col-10-10 pull-right" type="text" name="" placeholder="日推广活动" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true" />
                            </div>
                        </div>
                        <br />
                        <div className="row">
                            <div className="col-md-12">
                                <HightCharts config={this.state.config}></HightCharts>
                            </div>
                        </div>
                    </div>
                );
            }
        });

        React.render(<ChartBuilding></ChartBuilding>, document.getElementById('analytics-container'));
    }
}
