import React from 'react'
import { connect } from 'react-redux'

export class Footer extends React.Component {
  render () {
    return (
      <div id={'footer'}>
        <div id={'rgpd'}>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
    )
  }
}

require('./Footer.scss')

export default connect()(Footer)
