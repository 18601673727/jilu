import React, { PropTypes } from 'react';
import Layout from '../../components/Layout';
import Link from '../../components/Link';
import Timer from '../../components/Timer';
import s from './Home.css';

const title = '记撸';

class HomePage extends React.Component {

  static propTypes = {
    // articles: PropTypes.array.isRequired,
  };

  componentDidMount() {
    document.title = title;
  }

  render() {
    return (
      <Layout className={s.content}>
        <Timer />
        <br/>
        <br/>
        <hr/>
        <Link to="/events">我的记录</Link>
      </Layout>
    );
  }

}

export default HomePage;
