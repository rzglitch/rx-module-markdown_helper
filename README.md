# rx-module-markdown_helper

본 모듈은 마크다운 에디터 전용 모듈로, 마크다운 원본 데이터를 별도 저장하도록 합니다.

## 설치

1. `<라이믹스 경로>/modules/markdown_helper` 내에 파일을 넣으세요.
2. 라이믹스 대시보드 페이지에서 DB 테이블 작성과 설치를 완료해 주세요.

## config.json 설정 방법

> 모듈 버전 0.1.2부터 config.json을 설치 시 자동 생성되도록 변경하였으며 위치는 다음과 같습니다.
> 파일 위치 : <라이믹스 경로>/files/markdown_helper/config.json

문서/댓글 외의 다른 곳에 마크다운 에디터를 사용하려면 config.json 파일을 수정해야 합니다.

```
{
  "srls": ["document_srl", "comment_srl", "new_srl", "new srl2", ...],
  "triggers": [
    ...
    [
      "test.testDeleteAction",
      "markdown_helper",
      "controller",
      "triggerDeleteMarkdown",
      "after"
    ],
    [
      "test.testInsertAction",
      "markdown_helper",
      "controller",
      "triggerInsertMarkdown",
      "after"
    ],
    [
      "test.testUpdateAction",
      "markdown_helper",
      "controller",
      "triggerUpdateMarkdown",
      "after"
    ]
  ]
}
```

`srls` 항목에는 각 게시물의 번호를 부여하는 srl 변수 이름을 넣고, `triggers` 항목에 Delete/Insert/Update 에 해당하는 trigger 액션을 넣으세요.

위 예시의 `test.test~~~Action`에는 각각 해당하는 trigger의 이름을 넣으면 됩니다.

## 라이선스

마크다운 헬퍼 모듈은 GNU GPL v2 라이선스의 적용을 받는 자유 소프트웨어(free software)입니다.
