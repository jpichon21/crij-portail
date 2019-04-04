import React from 'react'
import { connect } from 'react-redux'
import * as Sample from '../../Sample'

export class Footer extends React.Component {
  render () {
    return (
      <div id={'footer'}>
        <div className={'logo'}>
          {
            Sample.logoFooter.map(logo => (
              <a href={logo.url}>
                <img src={logo.image} alt={logo.title} />
              </a>
            ))
          }
        </div>
        <ul className={'menu'}>
          {
            Sample.menuFooter.map(item => (
              <li><a href={item.url}>{item.title}</a></li>
            ))
          }
        </ul>
        <div id={'rgpd'}>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    )
  }
}

require('./Footer.scss')

export default connect()(Footer)
