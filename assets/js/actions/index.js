export const getBeers = text => ({
  type: 'GET_BEERS',
  text
})

export function addBeer (attributes) {
  return dispatch => {
    dispatch({
      type: 'ADD_BEER',
      data: attributes
    })
  }
}

export function fetchBeers () {
  return dispatch => {
    dispatch({
      type: 'FETCH_BEERS' })
    return window.fetch('https://api.punkapi.com/v2/beers')
      .then(handleErrors)
      .then(res => res.json())
      .then(json => {
        dispatch({ type: 'FETCH_BEERS_SUCCESS', data: json })
        return json
      })
      .catch(error => dispatch({ type: 'FEETCH_BEERS_ERROR', data: error }))
  }
}

function handleErrors (response) {
  if (!response.ok) {
    console.error(response.statusText)
    throw Error(response.statusText)
  }
  return response
}
