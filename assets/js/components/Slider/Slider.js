import React from 'react'
import { connect } from 'react-redux'
import Glide from '@glidejs/glide'

export class Slider extends React.Component {
  componentDidMount () {
    new Glide('#glide', {
      type: 'carousel',
      gap: 0,
      dots: true,
      autoplay: 5000,
      animationDuration: 1500
    }).mount()
  }
  render () {
    return (
      <div id={'glide'}>
        <div className={'glide__track'} data-glide-el={'track'}>
          <ul className={'glide__slides'}>
            {
              this.props.items.map((item, index) => (
                <li key={index} className={'glide__slide'} style={{ backgroundImage: `url(${item.image})` }}>
                  <div className={'glide__overlay'}>
                    <a href={item.link}>
                      <h2 className={'glide__title'}>{item.title}</h2>
                      <div className={'glide__excerpt'}>{item.excerpt}</div>
                    </a>
                  </div>
                </li>
              ))
            }
          </ul>
        </div>
        <div className='glide__bullets' data-glide-el='controls[nav]'>
          {
            this.props.items.map((item, index) => (
              <button key={index} className={'glide__bullet'} data-glide-dir={index} title={item.title} />
            ))
          }
        </div>
        <div className={'glide__content'}>
          {
            this.props.children
          }
        </div>
      </div>
    )
  }
}

require('./Slider.scss')

export default connect()(Slider)
