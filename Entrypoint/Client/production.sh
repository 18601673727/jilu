#!/usr/bin/env bash
npm install -g react-app node-static
cd /usr/src/app
npm install
react-app build
static -a 0.0.0.0 public
