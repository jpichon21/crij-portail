import React from 'react'
import { connect } from 'react-redux'

export class Tile extends React.Component {
  render () {
    return (
      <a href={this.props.item.link} className={'tile'} style={{ backgroundColor: this.props.item.color }}>
        <img src={this.props.item.icon} />
        <h3>{this.props.item.title}</h3>
      </a>
    )
  }
}

require('./Tile.scss')

export default connect()(Tile)
