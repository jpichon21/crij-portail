import React from 'react'

const BeerForm = ({ handleSubmit }) => {
  let name
  let imageUrl
  return (
    <div>
      <form
        onSubmit={e => {
          e.preventDefault()
          handleSubmit(name.value, imageUrl.value)
        }}
      >
        <input ref={node => (name = node)} />
        <input ref={node => (imageUrl = node)} />
        <input type='submit' value='add' />
      </form>
    </div>
  )
}

export default BeerForm
