import React from 'react'
import { connect } from 'react-redux'
import * as Sample from '../../Sample'

export class Header extends React.Component {
  render () {
    return (
      <header id={'header'}>
        <div className={'left'}>
          <img src={Sample.logo_crij} alt='CRIJ' />
        </div>
        <div className={'right'}>
          <ul className={'links'}>
            <li><a href={'#'}><i className='far fa-question-circle' />Besoin d'aide ?<br />Une question ?</a></li>
            <li><a href={'#'}><i className='far fa-user' />Je me connecte<br />Je m'inscris</a></li>
            <li><a href={'#'}><i className='far fa-envelope' />Inscription<br />Newsletter</a></li>
          </ul>
          <div className={'socials'}>
            <span>Suivez-nous !</span>
            <ul>
              <li><a href={'#'}><i style={{ color: '#4267b2' }} className='fab fa-facebook' /></a></li>
              <li><a href={'#'}><i style={{ color: '#CC0000' }} className='fab fa-youtube' /></a></li>
              <li><a href={'#'}><i style={{ color: '#00acee' }} className='fab fa-twitter' /></a></li>
              <li><a href={'#'}><i style={{ color: '#c61689' }} className='fab fa-instagram' /></a></li>
            </ul>
          </div>
          <a href={'#'}><img className={'logo-ij'} src={Sample.logo_ij} alt={'Information Jeunesse Bourgogne Franche Comte'} /></a>
        </div>
      </header>
    )
  }
}

require('./Header.scss')

export default connect()(Header)
