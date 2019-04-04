import React from 'react'
import { connect } from 'react-redux'

export class Header extends React.Component {
  render () {
    return (
      <header id={'header'}>
        <div className={'left'}>
          <img src={'build/img/logo_crij.png'} alt='CRIJ' />
        </div>
        <div className={'right'}>
          <ul className={'links'}>
            <li><a href={'#'}><i className='far fa-question-circle' />Besoin d'aide ?<br />Une question ?</a></li>
            <li><a href={'#'}><i className='far fa-user' />Je me connecte<br />Je m'inscris</a></li>
            <li><a href={'#'}><i className='far fa-envelope' />Inscription<br />Newsletter</a></li>
          </ul>
          <ul className={'socials'}>
            <li><a href={'#'}><i style={{ color: '#4267b2' }} className='fab fa-facebook' /></a></li>
            <li><a href={'#'}><i style={{ color: '#CC0000' }} className='fab fa-youtube' /></a></li>
            <li><a href={'#'}><i style={{ color: '#00acee' }} className='fab fa-twitter' /></a></li>
            <li><a href={'#'}><i style={{ color: '#c61689' }} className='fab fa-instagram' /></a></li>
          </ul>
          <a href={'#'}><img className={'logo-ij'} src={'build/img/logo-ij-bfc.png'} alt={'Information Jeunesse Bourgogne Franche Comte'} /></a>
        </div>
      </header>
    )
  }
}

require('./Header.scss')

export default connect()(Header)
