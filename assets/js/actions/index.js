import { login } from './Api'

export function getCredentials () {
  return dispatch => {
    dispatch({ type: 'GET_CREDENTIALS' })
    return login()
      .then(res => {
        dispatch({ type: 'GET_CREDENTIALS_SUCCESS', data: res.data })
      })
      .catch(error => {
        dispatch({ type: 'GET_CREDENTIALS_ERROR', data: error })
      })
  }
}
