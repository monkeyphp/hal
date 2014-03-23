<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hal;

/**
 *
 * @author David White <david@monkeyphp.com>
 */
interface ResourceInterface
{
    /**
     * Return an array representation of the Resource
     */
    public function toArray();
}
