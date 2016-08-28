@extends('layout')

@section('title', '仪表盘')

@section('content')
    <div class="header">
        <img src="/image/logo.png" alt="jilu">
    </div>

    <div class="body">
        <div id="stopwatch">
            <div class="time-display">0:00:00.00</div>
            <div class="weui_btn_area">
                <button class="weui_btn weui_btn_primary start-button">走你</button>
                <button class="weui_btn weui_btn_primary record-button" style="display: none;">到位</button>
                <button class="weui_btn weui_btn_warn stop-button" style="display: none;">重来</button>
            </div>
            <input type="hidden" id="user-id" value="{{ auth()->user()->id }}">
        </div>
    </div>

    <div class="weui_extra_area">
        <div class="weui_btn_area">
            <a class="weui_btn weui_btn_plain_default" href="/events">{{ session('wechat.oauth_user')->nickname }} 的记录</a>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function Stopwatch(selector) {
            this.stopwatch = $(selector);
            this.timeDisplay = this.stopwatch.find('.time-display').first();
            this.startButton = this.stopwatch.find('.start-button').first();
            this.stopButton = this.stopwatch.find('.stop-button').first();
            this.recordButton = this.stopwatch.find('.record-button').first();
            this.timer = 0;
            this.diff = 0;
            this.startedAt = null;
            this.endedAt = null;

            this.init();
        }

        Stopwatch.prototype.init = function () {
            var self = this;

            self.startButton.on('click', function (e) {
                e.preventDefault();
                self.start();

                self.startButton.hide();
                self.stopButton.show();
                self.recordButton.show();
            });

            self.stopButton.on('click', function (e) {
                e.preventDefault();
                self.stop();

                self.startButton.show();
                self.stopButton.hide();
                self.recordButton.hide();
            });

            self.recordButton.on('click', function (e) {
                e.preventDefault();
                self.stop();
                self.record();
            });
        };

        Stopwatch.prototype.start = function () {
            this.startedAt = moment();

            // Start a infinite loop to count up
            this.timer = setInterval(function () {
                this.diff = moment().diff(moment(this.startedAt));
                this.timeDisplay.html(moment.duration(this.diff, "ms").format({
                    template: "h:mm:ss",
                    precision: 2,
                    trim: false
                }));
            }.bind(this), 50);

            console.log(this);
        };

        Stopwatch.prototype.stop = function () {
            clearInterval(this.timer);
            this.timeDisplay.html('0:00:00.00');
        };

        Stopwatch.prototype.record = function () {
            this.recordButton.addClass('weui_btn_disabled');

            this.endedAt = moment();

            var data = {
                name: "撸管",
                score: 5,
                started_at: this.startedAt.valueOf(),
                ended_at: this.endedAt.valueOf(),
                user_id: $('#user-id').val(),
            };

            $.post('/events', data, function(event) {
                window.location.href = '/events/' + event.id + '/edit';
            });
        };

        var stopwatch = new Stopwatch('#stopwatch');
    </script>
@endsection
