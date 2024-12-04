package models

type User struct {
	ID       uint   `gorm:"primaryKey"`
	Username string `gorm:"not null"`
	Password string `gorm:"not null"`
	Role     string `gorm:"default:subscriber"`
}
