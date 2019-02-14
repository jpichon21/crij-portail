import React from 'react'
import { connect } from 'react-redux'
import BeerForm from './BeerForm'
import BeerList from './BeerList'
import { addBeer, fetchBeers } from '../actions'

class BeerView extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      beers: []
    }
    this.handleAddBeer = this.handleAddBeer.bind(this)
  }

  componentDidMount () {
    this.props.dispatch(fetchBeers())
  }

  componentWillReceiveProps (newProps) {
    if (newProps.beers !== this.state.beers) {
      this.setState({ beers: newProps.beers })
    }
  }
  handleAddBeer (name, imageUrl) {
    this.props.dispatch(addBeer({ name: name, imageUrl: imageUrl }))
  }
  render () {
    return (
      <div>
        <BeerForm handleSubmit={this.handleAddBeer} />
        <BeerList beers={this.state.beers} />
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
