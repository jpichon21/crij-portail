import React from 'react'
import { connect } from 'react-redux'
import Socials from '../Socials/Socials'
import * as Sample from '../../Sample'

export class Header extends React.Component {
  constructor (props) {
    super(props)
    this.state = {
      toggled: false,
      logo: Sample.logoCRIJ,
      category: Sample.category
    }
    this.handletoggleMenu = this.handletoggleMenu.bind(this)
  }
  handletoggleMenu () {
    this.setState({ toggled: !this.state.toggled })
  }
  render () {
    return (
      <header id={'header'}>
        <div className={'left'}>
          <img className={'logo'} src={this.state.logo} alt='CRIJ' />
          <img className={'category'} src={this.state.category.logo} style={{ backgroundColor: this.state.category.color }} alt='CRIJ Category' />
        </div>
        <div className={'right'}>
          <ul className={`menu ${this.state.toggled ? 'active' : ''}`}>
            <li><a href={'#'}><i className='far fa-question-circle' />Besoin d'aide ?</a></li>
            <li><a href={'#'}><i className='far fa-user' />Espace perso</a></li>
            <li><a href={'#'}><i className='far fa-envelope' />Newsletter</a></li>
          </ul>
          <Socials />
          <div className={'toggleMenu'} onClick={() => this.handletoggleMenu()}><i className={'fas fa-bars'} />Menu</div>
        </div>
      </header>
    )
  }
}

require('./Header.scss')

export default connect()(Header)
