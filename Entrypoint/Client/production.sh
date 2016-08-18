#!/usr/bin/env bash
npm install -g react-app node-static
cd /usr/src/app
npm install
react-app build
static -z -a 0.0.0.0 public
