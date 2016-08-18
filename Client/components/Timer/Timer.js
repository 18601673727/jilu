import React from 'react';
import Link from '../Link';
import moment from 'moment';
import Stopwatch from 'timer-stopwatch';
import s from './Timer.css';
require("moment-duration-format");

class Timer extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      started: false,
      during: 0,
    };
  }

  componentDidMount() {
    this.timer = new Stopwatch();
    this.timer.onTime((time) => {
      this.setState({
        during: time.ms
      });
    });
  }

  componentWillUnmount() {
    this.timer.stop();
  }

  handleClick = (event) => {
    event.preventDefault();

    if (this.state.started) {
      this.setState({started: false});

      this.timer.stop();
      return;
    }

    this.setState({
      started: true
    });

    this.timer.reset(0);
    this.timer.start();
  };

  render() {
    const duration = moment.duration(this.state.during, "ms").format({
      template: "h:mm:ss",
      precision: 2,
      trim: false
    });
    return (
      <div>
        <h3 className={s.clock}>{duration}</h3>
        <button className={s.startButton} onClick={this.handleClick}>
          {this.state.started ? "再来!" : "走你!"}
        </button>
        <br/>
        {
          this.state.started && <Link className={s.startLink} to="/event/new">到位了!</Link>
        }
      </div>
    );
  }

}

export default Timer;
