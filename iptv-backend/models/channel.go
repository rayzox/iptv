package models

type Channel struct {
	ID   uint   `gorm:"primaryKey"`
	Name string `gorm:"not null"`
	URL  string `gorm:"not null"`
}
