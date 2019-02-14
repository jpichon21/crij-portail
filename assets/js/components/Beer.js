import React from 'react'
import PropTypes from 'prop-types'

const Beer = ({ name, imageUrl }) => (
  <li>{name} <img src={imageUrl} /></li>
)

Beer.propTypes = {
  name: PropTypes.string.isRequired,
  imageUrl: PropTypes.string.isRequired
}

export default Beer
