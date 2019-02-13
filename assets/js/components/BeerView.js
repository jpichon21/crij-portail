import React from 'react'
import { connect } from 'react-redux'
import BeerForm from './BeerForm'
import { addBeer } from '../actions'

class BeerView extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      beers: []
    }
    this.handleAddBeer = this.handleAddBeer.bind(this)
  }
  handleAddBeer (name, imageUrl) {
    this.props.dispatch(addBeer({ name: name, imageUrl: imageUrl }))
  }
  render () {
    return (
      <div>
        <BeerForm handleSubmit={this.handleAddBeer} />
      </div>
    )
  }
}

const mapStateToProps = state => {
  return {
    beers: state.beers
  }
}

export default connect(mapStateToProps)(BeerView)
