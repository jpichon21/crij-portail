import React from 'react'
import { connect } from 'react-redux'
import * as Sample from '../../Sample'

export class Stripe extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      contents: Sample.contents
    }
  }
  render () {
    return (
      <div href={this.props.item.url} className={'stripe'} style={{ backgroundColor: this.props.item.color }}>
        <div className={'icon'}>
          <img src={this.props.item.icon} />
          <h3>{this.props.item.title}</h3>
        </div>
        <ul className={'menu'}>
          {
            this.state.contents.map((content, index) => (
              <li key={index}>
                <a href={content.url}>{content.title}</a>
              </li>
            ))
          }
        </ul>
        <div className={'thumb'}>
          <img src={this.props.item.thumb} />
        </div>
      </div>
    )
  }
}

require('./Stripe.scss')

export default connect()(Stripe)
