import React from 'react'
import { connect } from 'react-redux'
import Socials from '../Socials/Socials'
import * as Sample from '../../Sample'

export class Header extends React.Component {
  constructor (props) {
    super(props)
    this.state = { toggled: false }
    this.handletoggleMenu = this.handletoggleMenu.bind(this)
  }
  handletoggleMenu () {
    this.setState({ toggled: !this.state.toggled })
  }
  render () {
    return (
      <header id={'header'}>
        <div className={'left'}>
          <img src={Sample.logoCRIJ} alt='CRIJ' />
          <img src={Sample.logoCategory} alt='CRIJ Category' />
        </div>
        <div className={'right'}>
          <ul className={`menu ${this.state.toggled ? 'active' : ''}`}>
            <li><a href={'#'}><i className='far fa-question-circle' />Besoin d'aide ?<br />Une question ?</a></li>
            <li><a href={'#'}><i className='far fa-user' />Je me connecte<br />Je m'inscris</a></li>
            <li><a href={'#'}><i className='far fa-envelope' />Inscription<br />Newsletter</a></li>
          </ul>
          <Socials />
          <a href={'#'} className={'logo-ij'}>
            <img src={Sample.logoIJ.desktop} className={'desktop'} alt={'Information Jeunesse Bourgogne Franche Comte'} />
            <img src={Sample.logoIJ.mobile} className={'mobile'} alt={'Information Jeunesse Bourgogne Franche Comte'} />
          </a>
          <div className={'toggleMenu'} onClick={() => this.handletoggleMenu()}><i className={'fas fa-bars'} />Menu</div>
        </div>
      </header>
    )
  }
}

require('./Header.scss')

export default connect()(Header)
