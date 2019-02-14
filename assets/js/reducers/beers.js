export default function beers (state, action) {
  switch (action.type) {
    case 'FETCH_BEERS_SUCCESS':
      return {
        ...state,
        beers: action.data.map(item => {
          item.imageUrl = item.image_url
          return item
        })
      }
    case 'GET_BEERS':
      return [
        ...state,
        {
          id: action.id,
          text: action.text,
          completed: false
        }
      ]
    case 'ADD_BEER':
      return {
        ...state,
        beers: [ ...action.data ]
      }
  }
  return state
}
