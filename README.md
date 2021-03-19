# atale.io Code Test

## Overview

This application allows users to find out how many ascendants and descendants they have.

Firstly, each user has to register himself by providing an email, the parent's email and each child's 
email. Only one parent can be chosen, but it is possible to choose several children.

## Running the code

- Clone the repository
- Run `composer install`
- Set up `.env` file by copying the `.env.example` and changing it accordingly
- Run `php artisan key:generate`
- Run `npm install` or `yarn install` and `npm dev` or `yarn dev`
- That's all, ready to go!

## Data Storage

To store hierarchical data in a database, there already are some mechanisms where each has its 
advantages and disadvantages.

For this test I chose to use Nested Sets, sacrificing the record insertion and removal time but greatly 
enhancing the reporting time. Since the main goal of this app is to present the user with his/her 
ascendants and descendants, it is important to quickly retrieve that information.

To implement the Nested Sets I used the 
[laravel-nestedset package](https://github.com/lazychaser/laravel-nestedset).