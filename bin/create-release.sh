#!/usr/bin/env bash

set -e

if [ $# -lt 1 ]; then
	echo "usage: $0 <version>"
	exit 1
fi

version=$1

sed -i '' -e "s/^ \* Version: .*/ * Version: ${version}/g" code-block-syntax-highlight.php;
sed -i '' -e "s/^ \* @version .*/ * @version ${version}/g" code-block-syntax-highlight.php;

rsync -a --exclude-from=.distignore ./ ./distribution/
cd distribution
zip -r ../code-block-syntax-highlight.zip ./
cd ../
rm -rf distribution
