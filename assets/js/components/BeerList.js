import React from 'react'
import PropTypes from 'prop-types'
import Beer from './Beer'

const BeerList = ({ beers }) => (
  <ul>
    {beers.map(beer => (
      <Beer key={beer.id} {...beer} />
    ))}
  </ul>
)

BeerList.propTypes = {
  beers: PropTypes.arrayOf(
    PropTypes.shape({
      id: PropTypes.number.isRequired,
      name: PropTypes.string.isRequired,
      imageUrl: PropTypes.string.isRequired
    }).isRequired
  ).isRequired
}

export default BeerList
