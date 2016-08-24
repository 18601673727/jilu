@extends('layout')

@section('title', '仪表盘')

@section('content')
    <div class="title m-b-md">
        <div id="stopwatch">
            <div class="time-display">00:00:00.00</div>
            <button class="start-button">走你</button>
            <button class="record-button" style="display: none;">到位</button>
            <button class="stop-button" style="display: none;">重来</button>
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
                window.location.href = '/record';
            });
        };

        Stopwatch.prototype.start = function () {
            this.startedAt = moment();

            // Start a infinite loop to count up
            this.timer = setInterval(function () {
                var diff = moment().diff(moment(this.startedAt));
                this.timeDisplay.html(moment.duration(diff, "ms").format({
                    template: "h:mm:ss",
                    precision: 2,
                    trim: false
                }));
            }.bind(this), 50);

            console.log(this);
        };

        Stopwatch.prototype.stop = function () {
            clearInterval(this.timer);
            this.endedAt = moment.now();
            this.timeDisplay.html('00:00:00.00');
        };

        var stopwatch = new Stopwatch('#stopwatch');
    </script>
@endsection
