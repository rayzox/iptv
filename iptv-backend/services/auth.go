package services

import "errors"

func ValidateUser(username, password string) error {
	if username == "admin" && password == "1234" {
		return nil
	}
	return errors.New("invalid username or password")
}
