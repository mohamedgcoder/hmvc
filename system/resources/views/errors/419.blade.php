@extends('errors::minimal')

@section('title', Str::title(__('errors.419.title')))

@section('code', '419')

@section('message', Str::of(__('errors.419.message'))->title()->toHtmlString())
