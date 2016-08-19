/**
 * React App SDK (https://github.com/kriasoft/react-app)
 *
 * Copyright © 2015-present Kriasoft, LLC. All rights reserved.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE.txt file in the root directory of this source tree.
 */

import React from 'react';
import history from '../../core/history';
import '../../components/Layout/Layout.css';
import Link from '../../components/Link';
import s from './Error.css';

class ErrorPage extends React.Component {

  static propTypes = {
    error: React.PropTypes.object,
  };

  componentDidMount() {
    document.title = this.props.error && this.props.error.status === 404 ?
      'Page Not Found' : 'Error';
  }

  goBack = event => {
    event.preventDefault();
    history.goBack();
  };

  render() {
    if (this.props.error) console.error(this.props.error); // eslint-disable-line no-console

    const [code, title] = this.props.error && this.props.error.status === 404 ?
      ['404', 'NOT FOUND'] :
      ['Error', '悲剧了,我们的代码有点问题'];

    return (
      <div className={s.container}>
        <main className={s.content}>
          <h1 className={s.code}>{code}</h1>
          <p className={s.title}>{title}</p>
          {code === '404' &&
            <p className={s.text}>
              您正在试图访问的页面没有找到,<br/><br/>或是还没有开发完成,
            </p>
          }

          <p className={s.text}>
            您可<a href="/" onClick={this.goBack}>后退</a>,&nbsp;或者前往&nbsp;<Link to="/">首页</Link>。
          </p>
        </main>
      </div>
    );
  }

}

export default ErrorPage;
