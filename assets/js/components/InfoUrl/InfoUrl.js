import React from 'react'
import { connect } from 'react-redux'

export class InfoUrl extends React.Component {
  render () {
    return (
      <div id={'info-box'}>
        <a href={this.props.url}>{this.props.url}</a>
        <p>{this.props.text}</p>
      </div>
    )
  }
}

require('./InfoUrl.scss')

export default connect()(InfoUrl)
