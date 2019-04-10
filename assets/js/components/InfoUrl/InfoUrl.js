import React from 'react'
import { connect } from 'react-redux'
import * as Sample from '../../Sample'

export class InfoUrl extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      title: Sample.infoUrl.title,
      text: Sample.infoUrl.text,
      button: Sample.infoUrl.button,
      url: Sample.infoUrl.url
    }
  }
  render () {
    return (
      <div id={'info-box'}>
        <h3>{this.state.title}</h3>
        <p>{this.state.text}</p>
        <a href={this.state.url}>{this.state.button}</a>
      </div>
    )
  }
}

require('./InfoUrl.scss')

export default connect()(InfoUrl)
