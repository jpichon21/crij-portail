import React from 'react'
import { connect } from 'react-redux'

export class Socials extends React.Component {
  render () {
    return (
      <div className={'socials'}>
        <span>Suivez-nous !</span>
        <ul>
          <li><a href={'#'}><i style={{ color: '#4267b2' }} className='fab fa-facebook' /></a></li>
          <li><a href={'#'}><i style={{ color: '#CC0000' }} className='fab fa-youtube' /></a></li>
          <li><a href={'#'}><i style={{ color: '#00acee' }} className='fab fa-twitter' /></a></li>
          <li><a href={'#'}><i style={{ color: '#c61689' }} className='fab fa-instagram' /></a></li>
        </ul>
      </div>
    )
  }
}

require('./Socials.scss')

export default connect()(Socials)
