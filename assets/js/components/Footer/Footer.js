import React from 'react'
import { connect } from 'react-redux'
import Socials from '../Socials/Socials'
import * as Sample from '../../Sample'

export class Footer extends React.Component {
  render () {
    return (
      <div id={'footer'}>
        <div className={'logo'}>
          {
            Sample.logoFooter.map((logo, index) => (
              <a key={index} href={logo.url}>
                <img src={logo.image} alt={logo.title} />
              </a>
            ))
          }
        </div>
        <ul className={'menu'}>
          {
            Sample.menuFooter.map((item, index) => (
              <li key={index}><a href={item.url}>{item.title}</a></li>
            ))
          }
        </ul>
        <Socials />
        <div id={'rgpd'}>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    )
  }
}

require('./Footer.scss')

export default connect()(Footer)
